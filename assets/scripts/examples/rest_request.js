import axios from 'axios'

/**
 * Baseurl defined in plugin level.
 */
const baseUrl = WPAPI.rest_url + 'yourNamespace/example'

/**
 * Perform GET request to /example/ endpoint.
 */
const get = async () => {  

  // Send request
  const response = await axios.get(baseUrl)
  
  return response.data
}

export default { get }
