import unittest
import time
from selenium.webdriver import Firefox

from page_objects import * # todo remove all import
from test_functional.base_testcase import BaseTestCase


class HomePageTest(BaseTestCase):

    def test_pageLoads(self):
        page_url = 'http://localhost/filehost/'

        self.browser.get(page_url)

        url = self.browser.current_url
        self.assertEqual(url, page_url)
