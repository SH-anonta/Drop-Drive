import unittest
from selenium.webdriver import Chrome

from page_objects import * # todo remove all import

class BaseTestCase(unittest.TestCase):
    def setUp(self):
        self.browser = Chrome()

    def tearDown(self):
        self.browser.close()


class HomePageTest(BaseTestCase):
    def __init__(self):
        super().__init__()

    def test_pageLoads(self):
        self.browser.get('localhost/filehost')
        url = self.browser.current_url()

        self.fail(url)
