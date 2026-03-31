import requests as r
import smtplib
import time
import os

from datetime      import datetime, timedelta
from email.message import EmailMessage
from dotenv        import load_dotenv

# Load the .env
load_dotenv()
API_KEY      = os.getenv("API_KEY")
EMAIL        = os.getenv("EMAIL")
APP_PASSWORD = os.getenv("APP_PASSWORD")
API_URL = "http://127.0.0.1:8000/api/tasks"


# Handles fetching pending task(s)
def fetchTask():
    try :
        # Due in 3 days
        due_3_days_str = (datetime.now() + timedelta(seconds=30)).strftime("%Y-%m-%d %H:%M:%S") # Change to hours=72

        params = {
            "status"  : "pending",
            "due_date": due_3_days_str 
        }

        headers = {
            "X-API-KEY": API_KEY,
            "Accept": "application/json"
        }

        response = r.get(API_URL, headers=headers, params=params)
        
        # Good response
        if response.status_code == 200:
            return response.json()

        # Bad response
        else:
            # Output test
            print(f"Error fetching tasks:\n{response.status_code}\n{response.text}")
            return []

    # Handles json not found error
    except ValueError as json_err:
        # Output test
        print(f"JSON decode error: {json_err}")
        return []

    except Exception as e:
        # Output test
        print(f"Unexpected error: {e}")
        return []

# Handles sending emails
def sendEmail(tasks):
    if not tasks:
        print("No tasks to send.")
        return

    # Build email content
    body = "Pending Tasks Due in 3 Days:\n\n"
    for t in tasks:
        body += f"- {t['title']} (Due: {t['due_date']})\n"

    msg = EmailMessage()
    msg["Subject"] = "Pending Tasks Reminder"
    msg["From"]   = EMAIL
    msg["To"]     = EMAIL
    msg.set_content(body)

    try:
        # Connect to Gmail SMTP
        with smtplib.SMTP_SSL("smtp.gmail.com", 465) as smtp:
            smtp.login(EMAIL, APP_PASSWORD)
            smtp.send_message(msg)
            # Output test
            print(f"Email sent! {len(tasks)} task(s) included.")

    except Exception as e:
        # Output test
        print("Error sending email:", e)

# Main loop
def main():
    # TODO: Better way to handle the loop 
    while True:
        tasks = fetchTask() # Fetch task
        sendEmail(tasks) # Sends email
        print("Next check in 30 seconds")
        time.sleep(30)


# A python script that runs a loop (1 day for 1 iteraion) which fetches pending
# tasks which are due in 3 days (72 hours) and emails them to the given
# email address in the .env file
if __name__ == "__main__":
    main()