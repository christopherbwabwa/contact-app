# Contact App

A simple web site with some contacts related to somes companies, like an agenda.

## Usage

- You can apply all RESTFUL operations to those contacts & to companies also.
- You can even filter them by multiples fields like company, first_name, last_name, and so on...

## Installation

For an easy start you can run the command:

```bash
git clone https://github.com/christopherbwabwa/contact-app.git
composer install
cp .env.example .env
npm install && npm run dev
```

You can seed some dummy data for testing with this command:

``` php artisan migrate:fresh --seed ```

You will then get some fake data ( users, companies, and contacts) to quickly test.

Each user has some companies with some contacts related.

Test Them and add more data on choice.

 `Enjoy :)`

