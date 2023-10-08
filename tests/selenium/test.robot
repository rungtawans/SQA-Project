*** Settings ***
Library    SeleniumLibrary

*** Test Cases ***
TC01 : Open Homepage
    Open Browser    http://127.0.0.1:8000    Chrome
    Log    This is executed.
    Capture Page Screenshot    TC01.jpg     
    [Teardown]    Close Browser
        
TC02 : Open Login Page
    Open Browser    http://127.0.0.1:8000/login    Chrome
    Log    This is executed.
    Capture Page Screenshot    TC02.jpg
    [Teardown]    Close Browser     
        
TC03 : Open Dashboard Page
    Open Browser    http://127.0.0.1:8000/login    Chrome
    Log    This is executed.
    Input text    username    admin@gmail.com   
    Input text    password    12345678
    Click Button    submit
    Location Should Be    http://127.0.0.1:8000/dashboard
    Capture Page Screenshot    TC03.jpg
    [Teardown]    Close Browser     
    
TC04 : Open Manage Fund Page
    Open Browser    http://127.0.0.1:8000/login    Chrome
    Log    This is executed.
    Input text    username    admin@gmail.com   
    Input text    password    12345678
    Click Button    submit
    Location Should Be    http://127.0.0.1:8000/dashboard
    Wait until element is visible    //*[@id="sidebar"]/ul/li[5]/a
    Click Link    //*[@id="sidebar"]/ul/li[5]/a
    Capture Page Screenshot    TC04.jpg
    Wait until element is visible   //*[@id="sidebar"]/ul/li[6]/a 
    Click Link    //*[@id="sidebar"]/ul/li[6]/a
    Capture Page Screenshot    TC05.jpg
    Wait until element is visible    //*[@id="sidebar"]/ul/li[7]/a  
    Click Link    //*[@id="sidebar"]/ul/li[7]/a
    Capture Page Screenshot    TC06.jpg
    Wait until element is visible    //*[@id="sidebar"]/ul/li[10]/a 
    Click Link    //*[@id="sidebar"]/ul/li[10]/a
    Capture Page Screenshot    TC07.jpg
    Wait until element is visible    //*[@id="sidebar"]/ul/li[11]/a
    Click Link    //*[@id="sidebar"]/ul/li[11]/a
    Capture Page Screenshot    TC08.jpg
    Wait until element is visible    //*[@id="sidebar"]/ul/li[12]/a
    Click Link    //*[@id="sidebar"]/ul/li[12]/a
    Capture Page Screenshot    TC09.jpg
    [Teardown]    Close Browser  
    