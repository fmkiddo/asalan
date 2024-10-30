CI_ENVIRONMENT			= {environment}

logger.threshold		= 5

app.baseURL				= '{system_url}'
app.charset				= {charset}
app.defaultLocale		= id
app.negotiateLocale		= false
app.supportedLocales	= '[id, en, fr]'
app.appTimezone			= Asia/Jakarta
app.indexPage			= '{system_index}'

server.brandLogoURL		= '{brand_url}'

cookie.prefix			= {cookie_prefix}
cookie.domain			= {cookie_domain}
cookie.httponly			= false

security.tokenName   	= '{csrf_token}'
security.headerName  	= 'X-CSRF-TOKEN'
security.cookieName  	= '{csrf_cookie}'
security.expires      	= 7200
security.regenerate  	= true
security.redirect		= production

session.driver			= '{session_driver}'
session.cookieName		= '{session_cookie_name}'
session.expiration		= 7200