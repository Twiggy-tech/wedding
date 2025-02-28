import type { Guest, SelectDrinksInput } from '../types'
import graphqlClient from '../utils/graphql-client'

export default async (input: SelectDrinksInput) => {
    try {
        const response = await graphqlClient.post('', {
            query: "mutation selectDrinks($input: SelectDrinksInput!) {\n" +
                "    selectDrinks(input: $input) { success }\n" +
                "}",
            variables: { input },
        });

        return response.data.data.selectDrinks.success as Boolean
    } catch (e) {
        console.error(e)
    }
}
