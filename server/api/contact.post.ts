import { z } from "zod";
import { schema} from "#shared/ContactFormScheme";
import { $fetch } from "ofetch";
import { SendEmailCommand, SES, SESClient } from "@aws-sdk/client-ses";
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

	const createSendEmailCommand = (toAddress:string, fromAddress:string) => {
		return new SendEmailCommand({
			Destination: {
				/* required */
				CcAddresses: [
					/* more items */
				],
				ToAddresses: [
					toAddress,
					/* more To-email addresses */
				],
			},
			Message: {
				/* required */
				Body: {
					/* required */
					Html: {
						Charset: "UTF-8",
						Data: "HTML_FORMAT_BODY",
					},
					Text: {
						Charset: "UTF-8",
						Data: "TEXT_FORMAT_BODY",
					},
				},
				Subject: {
					Charset: "UTF-8",
					Data: "EMAIL_SUBJECT",
				},
			},
			Source: fromAddress,
			ReplyToAddresses: [
				/* more items */
			],
		});
	};
	const aws: AwsClient = new AwsClient({
		accessKeyId:config.mailUser,
		secretAccessKey:config.mailPassword,
	})

	let email2= await aws.fetch("https://email.us-east-1.amazonaws.com?"+new URLSearchParams({
		'Action': "SendEmail",
		'Source':"noreply@jortuck.com",
		'Destination.ToAddresses.member.1':config.mailDestination,
		'Message.Subject.Data':"Test Email",
		'Message.Body.Text.Data':"Test Message"
	}),{
		method: "GET"
	})
	// let sesClient = new SESClient({
	// 	region:"us-east-1",
	// 	credentials:{
	// 		accessKeyId:config.mailUser,
	// 		secretAccessKey:config.mailPassword
	// 	}
	// })

	// const run = async () => {
	// 	const sendEmailCommand = createSendEmailCommand(
	// 		"jordan@jortuck.com",
	// 		"noreply@jortuck.com",
	// 	);
	// 	try {
	// 		return await sesClient.send(sendEmailCommand);
	// 	} catch (caught) {
	// 		if (caught instanceof Error && caught.name === "MessageRejected") {
	// 			/** @type { import('@aws-sdk/client-ses').MessageRejected} */
	// 			const messageRejectedError = caught;
	// 			return messageRejectedError;
	// 		}
	// 		throw caught;
	// 	}
	// };
	// await run();
	// const transporter = createTransport({
	// 	host: useRuntimeConfig().mailHost,
	// 	port: 465,
	// 	secure: true,
	// 	auth: {
	// 		user: useRuntimeConfig().mailUser,
	// 		pass: useRuntimeConfig().mailPassword,
	// 	}
	// })
	// const info = await transporter.sendMail({
	// 	from: '"Contact Form" <noreply@jortuck.com>', // sender address
	// 	replyTo:`"${result.data.name}" <${result.data.email}>"`, // reply ro address
	// 	to: useRuntimeConfig().mailDestination, // list of receivers
	// 	subject: result.data.subject, // Subject line
	// 	text: result.data.message, // plain text body
	// });
	return {success:true,message:"Your message has been sent!"}
});
