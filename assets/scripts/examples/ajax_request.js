import axios from 'axios'

const ajaxurl = WPAPI.ajax_url

/**
 * Perform AJAX request to example endpoint/action.
 */
const request = async ( data ) => {

  const params = new URLSearchParams()
  params.append('action', 'your_action_name')
  params.append('data', data)

  // Note: WPAPI.ajax_nonce is not on by default.
  // params.append('nonce', WPAPI.ajax_nonce)

  // Send request
  const response = await axios.post(ajaxurl, params )

  return response
}

export default { request }
