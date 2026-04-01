# Camera20 POS System

A modern Point of Sale (POS) system built using CodeIgniter 4. This system is designed for high concurrency, reliable database transactions, and secure atomic stock tracking.

## Requirements

- **PHP**: ^8.1
- **Database**: MySQL 5.7+ or MariaDB 10.2+
- **Composer**: Optional but recommended for installing PHP dependencies
- **Web Server**: Apache, Nginx, or the built-in PHP development server

## First-Time Installation & Setup

Follow these steps to configure and run the POS system for the first time.

### 1. Environment Configuration

1. In the root directory, copy the `env` file to `.env`:
   ```bash
   cp env .env
   ```
2. Open the `.env` file and set your environment to development to easily catch errors:
   ```env
   CI_ENVIRONMENT = development
   ```
3. Set your application's base URL (e.g., `localhost` or your local domain):
   ```env
   app.baseURL = 'http://localhost:8080/'
   ```
4. Define your Database connection settings. Remove the `#` prefix from the following lines and fill in your credentials:
   ```env
   database.default.hostname = localhost
   database.default.database = your_database_name
   database.default.username = your_database_username
   database.default.password = your_database_password
   database.default.DBDriver = MySQLi
   database.default.port     = 3306
   ```

### 2. Install Dependencies

If you are missing any vendor packages, ensure Composer is installed and run:
   ```bash
   composer install
   ```

### 3. Initialize the Database Schema

The system uses CodeIgniter Migrations to instantly construct the internal tables with proper data types and cascading Foreign Key constraints.

Run the following Spark command to automatically create the table structures:
   ```bash
   php spark migrate
   ```

*(Note: Ensure your database is completely empty before running migrations to avoid potential conflicts with legacy tables).*

### 4. Running the Application locally

Once configured, you can launch the site logically through your desired web server or by running CodeIgniter's internal development server:
   ```bash
   php spark serve
   ```
Navigate to `http://localhost:8080` in your web browser. 

## Architectural Refactoring Notes

The system now acts with enterprise-level safeguards.
- **Race Condition Prevention**: Purchasing stock triggers an explicit database `SET stock = stock - quantity` command ensuring concurrent checkouts never corrupt stock totals.
- **Database Transactions**: Multi-step actions (such as paying or committing cart layouts) run within `$this->db->transStart()`. In the event a script crashes, database changes are completely rolled-back automatically.
- **Performance**: High-speed, natively auto-incrementing BigInt IDs handle table relationships, ensuring that massive datasets don't slow down SQL lookups.

## Continuous Deployment (CI/CD)

The system is configured with a robust **Multi-Tenant Deployment Pipeline** using GitHub Actions (`.github/workflows/deployment.yml`). This allows you to effortlessly distribute POS updates to all of your customers simultaneously using Matrix Environments.

### Deploying Updates
1. Navigate to the **Actions** tab in this GitHub repository.
2. Select the **Multi-Tenant POS Deployment** workflow.
3. Click "Run workflow".
4. You will be prompted for a `client` identifier.
    * Leave it as `all` to cycle through your master list of customers and deploy to all of them sequentially.
    * Or, type a specific client's identifier (e.g. `client_a`) to ONLY push code to that single customer.

### Boarding New Customers (Configuration)
When you sell this POS to a new customer, you must register them in GitHub safely to automatically map their FTP credentials:
1. Go to your repository **Settings** -> **Environments**.
2. Click **New Environment** and name it matching their identifier (e.g., `client_d`).
3. Under Environment Secrets, generate the following exactly named variables:
    * `FTP_SERVER`
    * `FTP_USERNAME`
    * `FTP_PASSWORD`
4. Update the fallback array in `.github/workflows/deployment.yml` (on line 21) to include the new client's name so that typing `all` deploys to them moving forward.

## Support

Refer to the official [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/) for further application development troubleshooting.
