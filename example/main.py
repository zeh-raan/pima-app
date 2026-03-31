import requests as r

# A python script that runs a loop (1 day for 1 iteraion) which fetches pending
# tasks which are due in 3 days (72 hours) and emails them to the given
# email address in the .env file

# NOTE: Loop iteration can be made smaller (i.e. 30 seconds) for testing