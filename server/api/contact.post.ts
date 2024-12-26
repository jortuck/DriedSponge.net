import { z } from "zod";
import { schema} from "#shared/ContactFormScheme";
import { $fetch } from "ofetch";
import { AwsClient } from 'aws4fetch'
export default defineEventHandler(async (event) => {
	let config = useRuntimeConfig(event);
	let result = await readValidatedBody(event,body=>schema.safeParse(body));

	if(!result.success){
		setResponseStatus(event, 400);
		return result.error.issues
	}

	let captcha = await $fetch("https://challenges.cloudflare.com/turnstile/v0/siteverify",{
		"method": "POST",
		body: {
			secret: config.turnstileSecret,
			response: result.data.cftoken,
		},
	})
	if(!captcha.success){
		setResponseStatus(event, 403);
		console.log(captcha)
		return {message:"Unfortunately my system has detected you as a bot. Please refresh your page or reach out via LinkedIn."}
	}

	const aws: AwsClient = new AwsClient({
		accessKeyId:config.awsAccessKeyId,
		secretAccessKey:config.awsSecretAccessKey,
	})
	await $fetch(config.discordWebhook,{
		method: "POST",
		body: {
			embeds:[{
				color:"6463980",
				title:`Contact Form Submission`,
				timestamp:new Date().toISOString(),
				description: `## ${result.data.subject}\n${result.data.message}`,
				fields:[
					{
						name:"Sender Name",
						value:result.data.name,
						inline:true,
					},
					{
						name:"Sender Email",
						value:result.data.email,
						inline:true,
					}
				]
			}]
		}
	})
	// let email2= await aws.fetch("https://email.us-east-1.amazonaws.com?"+new URLSearchParams({
	// 	'Action': "SendEmail",
	// 	'Source':"Contact Form <noreply@jortuck.com>",
	// 	'Destination.ToAddresses.member.1':config.mailDestination,
	// 	'Message.Subject.Data':`Message From ${result.data.name}: ${result.data.subject}`,
	// 	'Message.Body.Text.Data':result.data.message,
	// 	'ReplyToAddresses.member.1':`${result.data.name} <${result.data.email}>`,
	// }),{
	// 	method: "GET"
	// })
	return {success:true,message:"Your message has been sent!"}
});
