import type { PageServerLoad } from "./$types";
import { API_KEY } from "$env/static/private";
import { PUBLIC_API_HOST } from "$env/static/public";
export const prerender = true;

export const load: PageServerLoad = async ({ params }) => {
	let data = await fetch(`${PUBLIC_API_HOST}/api/projects?populate=*&sort=createdAt:asc`, {
		headers: {
			Authorization: `Bearer ${API_KEY}`
		}
	});
	let projects = await data.json();

	return {
		projects: projects.data
	};
};


