import type { Guest, EditGuestInput } from '../types'
import graphqlClient from '../utils/graphql-client'

export default async (input: EditGuestInput) => {
    try {
        const response = await graphqlClient.post('', {
            query: "mutation editGuest($input: EditGuestInput!) {\n" +
                "    editGuest(input: $input) {" +
                "       guest {\n" +
                "           id\n" +
                "           firstName\n" +
                "           surname\n" +
                "           willAttend\n" +
                "           token\n" +
                "           gender\n"+
                "           willAttendMainCeremony\n"+
                "       }\n" +
                "    }\n" +
                "}",
            variables: { input },
        });

        return response.data.data.editGuest.guest as Guest
    } catch (e) {
        console.error(e)
    }
}
