/*~ readme.txt
.---------------------------------------------------------------------------.
|  Software: QuickCache                                                     |
|   Version: 2.1rc1                                                         |
|   Contact: andy.prevost@worxteam.com                                      |
|      Info: http://sourceforge.net/projects/quickcache                     |
|   Support: http://sourceforge.net/projects/quickcache                     |
| ------------------------------------------------------------------------- |
|    Author: Andy Prevost andy.prevost@worxteam.com (admin)                 |
|    Author: Jean-Pierre Deckers (original founder)                         |
| Copyright (c) 2004-2007, Andy Prevost. All Rights Reserved.               |
| Copyright (c) 2001-2003, Jean-Pierre Deckers jp@jpcache.com               |
|    * NOTE: QuickCache is the 'jpcache' project renamed. 'jpcache          |
|            information and downloads can still be accessed at the         |
|            sourceforge.net site                                           |
| ------------------------------------------------------------------------- |
|   License: Distributed under the General Public License (GPL)             |
|            http://www.gnu.org/copyleft/gpl.html                           |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
| ------------------------------------------------------------------------- |
| We offer a number of paid services:                                       |
| - Web Hosting on highly optimized fast and secure servers                 |
| - Technology Consulting                                                   |
| - Oursourcing (highly qualified programmers and graphic designers)        |
'---------------------------------------------------------------------------'
Last modified: October 31 2007 ~*/

/* **************************************************************************
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *************************************************************************** */

QuickCache v2.1rc1
http://sourceforge.net/projects/quickcache 

Copyright (c) 2004-2007, Andy Prevost. All Rights Reserved.
Copyright 2001-2003 Jean-Pierre 'Pier' Deckers <jp@jpcache.com>
  
  Summary:
    QuickCache is a lightweight, full page caching system for PHP, 
    reducing server-load, as pages are generated less often.
    It also uses gzip content-encodig and ETag-headers, which results
    in approximately 80% in bandwidth savings for pages sent to browsers.
    You can choose to store your files in a temporary file or a database.
  
  Features:
    - Caches full pages.
    - When not modified since last visit, sends 304 response
    - When modified or first visit, sends gzipped content if possible, 
      else uncompressed content
    - You can choose between file or MySQL based storage, or adapt the
      template for your own storage system, like dbm.
      
  Requirements:
    - PHP4.1.0+
    - MySQL when using the sql-version etc.

  Release-notes for v2.1 (all versions and up)
    - see attached changelog.txt (attached)

  Release-notes for v2
    - Totally rewritten the 1.1 code, seperated main-code from storage-system
    - Merged lots of suggestions, patches etc. Should now be Windows-compatible
      out of the box.
    See sourceforge.net for the full changelog.
          
  File vs. sql-storage:
    Although the file-storage seems to be faster, you might prefer the 
    sql-version, as it has much faster garbagecollection. 
    
    I recommend using the sql-based storage if the cache-files are always 
    of size 0:
    "On some operating systems flock() is implemented at the process level. 
    When using a multithreaded server API like ISAPI you may not be able to 
    rely on flock() to protect files against other PHP scripts running in 
    parallel threads of the same server instance!" --- PHP.net
    
  Installation and usage:
    0) Decide whether to go for the file- or database-storage.
    1) Edit quickcache.php and change the includedir-setting to the directory
       which contains the QuickCache program files.
       Note: use the full path, not virtual path settings.
    2) Edit quickcache_config.php and change the configuration settings. 
       If you use the mysql-storage, enter the correct settings for accessing 
       the database.
       If you do not choose mysql-storage, file based storage is assumed. Make
       sure your directory is writable. The file based storage settings for
       directory have to be the full path, not virtual path settings.
    3) If you use the sql-version, create the database that is used for storing
       the cachedata (default name: "quickcache"). Within this database, create 
       the required table as provided in type/script.sql.
       You can use the mysql-client for this:
       mysql <db-name> < script.sql
       or you can use phpMyAdmin <http://phpwizard.net/phpMyAdmin> to read
       in the dump.
    4) You can easily test QuickCache with the following file:
       <?php
       require "quickcache.php";
       echo time();
       phpinfo();
       ?>
       Request this file from you browser, refresh, and see if the time written
       is the same. 
    5) If everything works, edit your php-files and add (directly to the top):
       
       <?php require "/path/to/quickcache/quickcache.php"; ?>
       
       OR
       
       <?php $cachetimeout=900; require "/path/to/quickcache/quickcache.php"; ?>       
       
       - Replace '900' with the number of seconds that the page should be cached.
       By default, pages will be cached for 900 seconds.
       
       - Setting '900' to -1 will disable caching and will only do content 
       encoding. Use this for pages which can not be cached, like personalized
       pages or with content that is always changing. Also when the page is 
       returning headers (like cookies in php), set the cachetimeout to -1, as
       header-information is not cached.
       
       - Setting '900' to 0 will create a non-expiring cache. This can be used 
       for pages that are not dynamic in content, but are heavy to generate.

Debugging:
    QuickCache can output debug-information, and does this by setting X-Debug 
    headers. Set $QCACHE_DEBUG to 1, and view the HTTP-headers with a tool like
    http://www.edginet.org/cgi-bin/http_head.cgi 
    This one also allows you to check if gzip is working.
    If offline, google for 'HTTP Header Viewer'
     
Credits:
    The following people have helped, tested, submitted suggestions or 
    code-updated for QuickCache (in no particular order):
    
    // TODO, screen mailbox
    
For more help, please see https://sourceforge.net/projects/jpcache/,
it contains a list of the most frequently asked questions, and all latest
information.

If you successfully deploy QuickCache on your servers, please add text link or 
link the button back to https://sourceforge.net/projects/jpcache/.
Please let us know about your usage, so we can keep track of the sites using
QuickCache.
     
Andy Prevost.
