import type { Guest } from '../types'
import graphqlClient from '../utils/graphql-client'

export default async (token: string) => {
    try {
        const response = await graphqlClient.post('', {
            query: "query fetchGuest($token: String!) {\n" +
                "    guest(token: $token) {\n" +
                "        id\n" +
                "        firstName\n" +
                "        surname\n" +
                "        token\n" +
                "        willAttend\n" +
                "        willAttendMainCeremony\n" +
                "        gender\n"+
                "    }\n" +
                "}",
            variables: { token },
        });

        return response.data.data.guest as Guest
    } catch (e) {
        console.error(e)
    }
}
