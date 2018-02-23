import unittest
from selenium.webdriver import Firefox


class BaseTestCase(unittest.TestCase):
    def setUp(self):
        self.browser = Firefox()

    def tearDown(self):
        self.browser.close()