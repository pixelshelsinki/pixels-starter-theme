import axios from 'axios'

/**
 * Baseurl defined in plugin level.
 */
const baseUrl = WPAPI.rest_url + 'yourNamespace/example'

/**
 * Perform GET request to /example/ endpoint.
 */
const get = async () => {

  // Send request, append REST Nonce.
  const response = await axios.get(baseUrl, { headers: {'X-WP-Nonce': WPAPI.rest_nonce} })

  return response.data
}

export default { get }
