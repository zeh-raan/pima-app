import requests as r
import smtplib
import os

from email.message import EmailMessage
from dotenv import load_dotenv

load_dotenv()

API_KEY = os.getenv("API_KEY")
EMAIL = os.getenv("EMAIL")
APP_PASSWORD = os.getenv("APP_PASSWORD")

API_URL = "http://127.0.0.1:8000/api/tasks"


# FETCH TASKS
def fetchTask():
    try:
        headers = {
            "X-API-KEY": API_KEY,
            "Accept": "application/json"
        }

        params = {
            "status": "missed"
        }

        response = r.get(API_URL, headers=headers, params=params)

        if response.status_code == 200:
            return response.json()

        print("Error:", response.status_code, response.text)
        return []

    except Exception as e:
        print("Fetch error:", e)
        return []


# SEND EMAIL
def sendEmail(tasks):
    if not tasks:
        print("No tasks found.")
        return

    body = "Missed Tasks:\n\n"

    for t in tasks:
        body += f"- {t['title']} (Due: {t['due_date']})\n"

    msg = EmailMessage()
    msg["Subject"] = "Missed Task Reminder"
    msg["From"] = EMAIL
    msg["To"] = EMAIL
    msg.set_content(body)

    try:
        with smtplib.SMTP_SSL("smtp.gmail.com", 465) as smtp:
            smtp.login(EMAIL, APP_PASSWORD)
            smtp.send_message(msg)

        print(f"Email sent with {len(tasks)} missed tasks")

    except Exception as e:
        print("Email error:", e)


# RUN ONCE
def main():
    tasks = fetchTask()
    sendEmail(tasks)
    print("Done")


if __name__ == "__main__":
    main()