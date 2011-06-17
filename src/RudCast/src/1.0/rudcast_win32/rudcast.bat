:: $Id$
@ECHO OFF
TITLE RudCast 1.0
COLOR F0
ECHO --------------------------------------------------------------------------------
ECHO Welcome to RudCast 1.0
ECHO.
ECHO Station: My Radio Station
ECHO.
ECHO --------------------------------------------------------------------------------
ECHO TIP: In order to stop broadcasting, simply close this window.
ECHO --------------------------------------------------------------------------------
ECHO.
ECHO Starting broadcast:
ECHO.
ezstream -c rudcast_mp3_reencode.xml
PAUSE
CLS