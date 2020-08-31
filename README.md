# Build Simple Login in PHP

This example shows how to create a PHP application with user authentication from scratch in PHP, using Okta OAuth 2.0 to handle user registration/login/logout/forgot password.

Please read [Build Simple Login in PHP](https://developer.okta.com/blog/2018/12/28/simple-login-php) to see how this application was built.

**Prerequisites:** PHP, Composer, [Okta developer account](https://developer.okta.com/)

> [Okta](https://developer.okta.com) has Authentication and User Management APIs that reduce development time with instant-on, scalable user infrastructure. Okta's intuitive API and expert support make it easy for developers to authenticate, manage, and secure users and roles in any application.

## Getting Started

Clone this project using the following commands:

```
git clone git@github.com:oktadeveloper/okta-php-core-login-example.git
cd okta-php-core-login-example
```

### Configure the application

Install the project dependencies, Copy the `.env` file and fill in your Okta details:

```
composer install
cp .env.example .env
```

### Run the application

From the project directory, run:

```
php -S 127.0.0.1:8080 -t public
```

Then open `http://localhost:8080` and you will see the application.

## Help

Please post any questions as comments on the [blog post](https://developer.okta.com/blog/2018/12/28/simple-login-php), or visit our [Okta Developer Forums](https://devforum.okta.com/). You can also email developers@okta.com if would like to create a support ticket.

## License

Apache 2.0, see [LICENSE](LICENSE).
