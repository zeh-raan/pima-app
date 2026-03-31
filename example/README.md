# Test Use-Case for Laravel RESTful API
This is a simple python script to demonstrate how the API is used. The script fetches pending tasks due in 3 days, daily, and mails them to a given email address.

## Setup & Usage
Follow these steps to setup everything the script needs. More specifically, your Google Account should have 2-Step Verification enabled and an app password ready!

### 1. Setup Google Account

1. **Enable 2FA**
    * Go to your [Google Account Security page](https://myaccount.google.com/security).
    * Follow the steps and enable 2-Step Verification.

2. **Generate an App Password**
    * Go to [App passwords (under "Security")](https://myaccount.google.com/apppasswords).
    * Follow the steps, generate the password and copy it somewhere to keep it.

### 2. Setup the script

1. **Setup environment variables**
    * Create a `.env` file containing:
        ```python
        API_KEY=your-key-here
        EMAIL=your-email-here
        APP_PASSWORD=your-app=password-here
        ```

2. **Run the script**
    ```bash
    python main.py
    ```