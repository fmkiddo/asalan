CI_ENVIRONMENT			= {environment}

app.baseURL				= '{system_url}'
app.charset				= {charset}
app.defaultLocale		= id
app.appTimezone			= Asia/Jakarta
app.indexPage			= '{system_index}'

logger.threshold		= 5

security.tokenName   	= '{csrf_token}'
security.headerName  	= 'X-CSRF-TOKEN'
security.cookieName  	= '{csrf_cookie}'
security.expires      	= 7200
security.regenerate  	= true
security.redirect		= production

session.driver			= '{session_driver}'
session.cookieName		= '{session_cookie_name}'
session.expiration		= 7200
session.savePath		= null