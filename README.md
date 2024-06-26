# SDGP - CS-79

Dedicated to addressing the pressing global issue of food scarcity while championing sustainable practices.Our mission is twofold: to mitigate the world food crisis and reduce food waste within society.
Through our innovative approach, we bridge the gap between sellers and buyers, facilitating the repurposing of surplus food into compost. Sellers have the opportunity to offer their excess food at discounted rates or donate it to those in need, fostering a culture of generosity and resourcefulness. Buyers, in turn, utilize this surplus to produce high-quality compost, contributing to both environmental conservation and economic viability. Together, we strive to create a more equitable and sustainable future for all.

# Zero Waste - A Web application to support food waste management

# Group Members :

- [@manishperera](https://www.github.com/octokatherine)
- [@ayaniranasinghe](https://github.com/ayaniranasinghe)
- [@OmiraGunasekara](https://github.com/OmiraGunasekara)
- [@mohammedyoosuf](https://github.com/mohammedyoosuf)
- [@ShashikaAmandi](https://github.com/ShashikaAmandi)

## Installation

1. Run composer installation

```bash
composer install
```

for production use

```bash
composer install --no-dev --optimize-autoloader
```

2. Create .env file

```bash
cp .env.example .env
```

3. Run migrations

```bash
php vendor/bin/phoenix migrate --config=app/configs/phoenix.php
```

And edit the content of `.env` file from deploy script or edit manually.

## Run migrations

Resource: https://github.com/lulco/phoenix

Command structure

Add ` --config=app/configs/phoenix.php` at the end of every command or run commands from that file location

```bash
php vendor/bin/phoenix {command} --config=app/configs/phoenix.php
```

create migrations

```bash
php vendor/bin/phoenix create "Migrations\BuyersMigration" migrations --config=app/configs/phoenix.php
```

Run migrations

```bash
php vendor/bin/phoenix migrate --config=app/configs/phoenix.php
```
