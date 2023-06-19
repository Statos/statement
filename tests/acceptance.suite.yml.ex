class_name: AcceptanceTester
modules:
    enabled:
        - WebDriver:
            url: http://statement/
            browser: firefox
        - Yii2:
            part: orm
            entryScript: index-test.php
            cleanup: false
