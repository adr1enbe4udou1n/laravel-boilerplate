export const SHARE_TWITTER = 'twitter'
export const SHARE_FACEBOOK = 'facebook'
export const SHARE_GOOGLE_PLUS = 'google-plus'
export const SHARE_LINKED_IN = 'linkedin'
export const SHARE_WHATSAPP = 'whatsapp'
export const SHARE_TELEGRAM = 'telegram'
export const SHARE_VIBER = 'viber'
export const SHARE_TUMBLR = 'tumblr'
export const SHARE_VK = 'vk'
export const SHARE_POCKET = 'get-pocket'
export const SHARE_BLOGGER = 'blogger'

const POPUP_OPTIONS = {
  width: 600,
  height: 480,
  left: window.innerWidth / 2 - 600 / 2 + window.screenX,
  top: window.innerHeight / 2 - 480 / 2 + window.screenY
}

const services = {
  [SHARE_TWITTER]: {
    url: 'https://twitter.com/intent/tweet/',
    params: data => {
      return {
        text: data.title,
        url: data.url
      }
    }
  },
  [SHARE_FACEBOOK]: {
    url: 'https://www.facebook.com/sharer/sharer.php',
    params: data => {
      return {
        u: data.url
      }
    }
  },
  [SHARE_GOOGLE_PLUS]: {
    url: 'https://plus.google.com/share',
    params: data => {
      return {
        url: data.url
      }
    }
  },
  [SHARE_LINKED_IN]: {
    url: 'https://www.linkedin.com/shareArticle',
    params: data => {
      return {
        url: data.url,
        mini: true
      }
    }
  },
  [SHARE_WHATSAPP]: {
    url: 'whatsapp://send',
    external: true,
    params: data => {
      return {
        text: `${data.title} ${data.url}`
      }
    }
  },
  [SHARE_TELEGRAM]: {
    url: 'https://telegram.me/share',
    external: true,
    params: data => {
      return {
        url: data.title,
        text: data.url
      }
    }
  },
  [SHARE_VIBER]: {
    url: 'viber://forward',
    external: true,
    params: data => {
      return {
        text: `${data.title} ${data.url}`
      }
    }
  },
  [SHARE_TUMBLR]: {
    url: 'http://tumblr.com/widgets/share/tool',
    params: data => {
      return {
        canonicalUrl: data.url,
        content: data.description,
        title: data.title,
        posttype: 'link'
      }
    }
  },
  [SHARE_VK]: {
    url: 'http://vk.com/share.php',
    params: data => {
      return {
        url: data.url,
        title: data.title,
        description: data.description
      }
    }
  },
  [SHARE_POCKET]: {
    url: 'https://getpocket.com/save',
    params: data => {
      return {
        url: data.url
      }
    }
  },
  [SHARE_BLOGGER]: {
    url: 'https://www.blogger.com/blog-this.g',
    params: data => {
      return {
        u: data.url,
        n: data.title,
        t: data.description
      }
    }
  }
}

function getPopUpParams() {
  const { width, height, left, top } = POPUP_OPTIONS
  return `scrollbars=no, width=${width}, height=${height}, top=${top}, left=${left}`
}

function getPreparedSharerUrl(service, params) {
  const preparedParams = service.params(params)
  const search = Object.keys(preparedParams)
    .map(key => {
      return key + '=' + preparedParams[key]
    })
    .join('&')
  return `${service.url}?${search}`
}

export const MAP = Object.keys(services).map(item => item)

export function share(social, params) {
  const service = services[social]
  if (!service) {
    return
  }

  const url = getPreparedSharerUrl(service, params)
  if (service.external) {
    window.location.href = url
  } else {
    window.open(url, '', getPopUpParams()).focus()
  }
}
