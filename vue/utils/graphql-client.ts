import axios from 'axios'

const graphqlClient = axios.create({
    baseURL: 'https://92.51.38.99:81/graphql/',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Methods': 'POST, OPTIONS',
        'Access-Control-Allow-Headers': 'Content-Type, Authorization',
    },
})

export default graphqlClient
