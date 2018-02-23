import unittest
import time
from selenium.webdriver import Chrome

from page_objects import * # todo remove all import

class BaseTestCase(unittest.TestCase):
    def setUp(self):
        self.browser = Chrome()

    def tearDown(self):
        self.browser.close()


class HomePageTest(BaseTestCase):

    def test_pageLoads(self):
        page_url = 'http://localhost/filehost/'

        self.browser.get(page_url)

        url = self.browser.current_url
        self.assertEqual(url, page_url)
