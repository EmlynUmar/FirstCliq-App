const BASE_URL = ''; // relative to support proxy in dev and origin in production

export async function apiRequest(url, options = {}) {
  const separator = url.includes('?') ? '&' : '?';
  const fullUrl = `${BASE_URL}${url}${separator}format=json`;

  options.credentials = 'include';

  if (options.body && typeof options.body === 'object' && !(options.body instanceof FormData)) {
    const params = new URLSearchParams();
    for (const [key, value] of Object.entries(options.body)) {
      params.append(key, value);
    }
    options.body = params;
    options.headers = {
      ...options.headers,
      'Content-Type': 'application/x-www-form-urlencoded',
    };
  }

  try {
    const response = await fetch(fullUrl, options);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('API Request failed:', error);
    throw error;
  }
}

export const api = {
  // Auth
  login: (phone, password) => 
    fetch(`${BASE_URL}/mobile/home/includes/route.php?login=YES`, {
      method: 'POST',
      body: new URLSearchParams({ phone, password }),
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      credentials: 'include'
    }).then(res => res.text()),

  register: (formData) =>
    fetch(`${BASE_URL}/mobile/home/includes/route.php?register=YES`, {
      method: 'POST',
      body: new URLSearchParams(formData),
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      credentials: 'include'
    }).then(res => res.text()),

  logout: () => apiRequest('/mobile/home/index.php?url=logout'),

  // Page specific data
  getPageData: (pageUrl) => apiRequest(`/mobile/home/index.php?url=${pageUrl}`),

  // Submit action / purchase
  submitAction: (pageUrl, actionName, payload) =>
    apiRequest(`/mobile/home/index.php?url=${pageUrl}`, {
      method: 'POST',
      body: {
        [actionName]: 'YES',
        ...payload
      }
    }),
};
