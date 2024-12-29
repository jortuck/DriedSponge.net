import { z } from "zod";

export const schema = z.object({
	name: z.string().nonempty("Name must contain at least 1 character.").max(50),
	email: z.string().email().nonempty().max(50),
	subject: z.string().nonempty("Subject must contain at least 1 character.").max(50),
	message: z.string().nonempty("Message must contain at least 1 character.").max(1000),
	cftoken: z.string().nonempty(),
})