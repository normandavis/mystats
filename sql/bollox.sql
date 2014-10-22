INSERT INTO `mystats`.`comments` (`id`, `name`, `email`, `website`,
       `comment`, `timestamp`, `articleid`) VALUES (NULL, '', '', '', 'the second comment', CURRENT_TIMESTAMP, '');


  INSERT INTO `mystats`.`comments` (`id`, `name`, `email`, `website`,
        `comment`, `timestamp`, `articleid`) VALUES (NULL, '$users_name',
        '$users_email', '$users_website', '$users_comment',
        CURRENT_TIMESTAMP, '$articleid');";


SELECT * 
FROM  `comments` 
WHERE  `articleid` =1
LIMIT 0 , 30
