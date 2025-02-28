import type { Drink } from '../types'
import graphqlClient from '../utils/graphql-client'

export default async () => {
    try {
        const response = await graphqlClient.post('', {
            query: "query {\n" +
                "    drinks {" +
                "       id " +
                "       name" +
                "    }\n" +
                "}",
        });

        return response.data.data.drinks as Drink[]
    } catch (e) {
        console.error(e)
    }
}
