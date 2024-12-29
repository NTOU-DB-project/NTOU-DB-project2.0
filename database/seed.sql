INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) 
VALUES (
    1, 
    'briantseng', 
    'bbt2587898123@gmail.com', 
    '$2y$10$NOt/NG5ILpL1p0RA2aCgFOE8.yWZQpgv8gVnLpAlAvEaroYQ3657m', 
    '2024-12-16 16:35:48'
);--password = zxcv7898
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) 
VALUES (
    1, 
    'brian', 
    'bbt2587898123@gmail.com', 
    '$2y$10$NOt/NG5ILpL1p0RA2aCgFOE8.yWZQpgv8gVnLpAlAvEaroYQ3657m', 
    '2024-12-16 16:35:48'
);--password = zxcv7898

INSERT INTO `notes` (`id`, `creator_id`, `title`, `content`, `updated_at`) 
VALUES (
    NULL, 
    '1', 
    'test', 
    '&lt;p&gt;&lt;span style=&quot;font-size: 36pt;&quot;&gt;1 Font size 36&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 24pt;&quot;&gt;2 Font size 24&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 18pt;&quot;&gt;3 Font size 18&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 14pt;&quot;&gt;4 Font size 14&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;strong style=&quot;font-size: 32px; color: rgb(255, 0, 0);&quot;&gt;Different&lt;/strong&gt;&lt;strong style=&quot;font-size: 24pt; color: rgb(255, 0, 0);&quot;&gt; &lt;/strong&gt;&lt;strong style=&quot;font-size: 24pt; color: rgb(0, 255, 30);&quot;&gt;c&lt;/strong&gt;&lt;strong style=&quot;font-size: 32px; color: rgb(0, 255, 30);&quot;&gt;olor &lt;/strong&gt;&lt;strong style=&quot;font-size: 24pt; color: rgb(106, 0, 255);&quot;&gt;text &lt;/strong&gt;&lt;strong style=&quot;font-size: 24pt; color: rgb(0, 148, 108);&quot;&gt;test &lt;/strong&gt;&lt;strong style=&quot;font-size: 24pt; color: rgb(0, 0, 0);&quot;&gt;|| &lt;/strong&gt;&lt;strong style=&quot;font-size: 32px; color: rgb(0, 0, 0); font-family: &amp;quot;Courier New&amp;quot;;&quot;&gt;Different &lt;/strong&gt;&lt;strong style=&quot;font-size: 24pt; color: rgb(0, 0, 0); font-family: Impact;&quot;&gt;Fonts &lt;/strong&gt;&lt;strong style=&quot;font-size: 24pt; color: rgb(0, 0, 0); font-family: Verdana;&quot;&gt;Text&lt;/strong&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;strong style=&quot;font-size: 18pt;&quot;&gt;&lt;u&gt;Images&lt;/u&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;img src=&quot;https://images.unsplash.com/photo-1593642532973-d31b6557fa68?ixid=MnwxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwxMXx8fGVufDB8fHx8&amp;amp;ixlib=rb-1.2.1&amp;amp;auto=format&amp;amp;fit=crop&amp;amp;w=400&amp;amp;q=60&quot; width=&quot;282&quot; height=&quot;278&quot;&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;table style=&quot;border: 1px solid #000;&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td data-row=&quot;row-jt3z&quot; style=&quot;text-align: center;&quot;&gt;&lt;strong style=&quot;font-size: 14pt;&quot;&gt;Tables&lt;/strong&gt;&lt;/td&gt;&lt;td data-row=&quot;row-jt3z&quot; style=&quot;text-align: center;&quot;&gt;&lt;a href=&quot;https://www.google.com/search?q=the+white+wolf+jumped+over+the&amp;amp;oq=the+white+wolf+jumped+over+the+&amp;amp;aqs=chrome..69i57j69i64l2.10256j0j7&amp;amp;sourceid=chrome&amp;amp;ie=UTF-8&quot; rel=&quot;noopener noreferrer&quot; target=&quot;_blank&quot; style=&quot;font-size: 14pt;&quot;&gt;links&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td data-row=&quot;row-vsnm&quot; style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: 18pt; background-color: rgb(217, 255, 0);&quot;&gt;Text Highlight&lt;/span&gt;&lt;/td&gt;&lt;td data-row=&quot;row-vsnm&quot; style=&quot;text-align: center;&quot;&gt;&lt;strong style=&quot;font-size: 14pt; color: rgb(255, 255, 255); background-color: rgb(255, 0, 217);&quot;&gt;Highlight With Different Colors&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;', 
    '2024-12-16 16:35:48'
);

INSERT INTO `note_auths` (`user_id`, `note_id`, `can_read`, `creator_id`)
VALUES (
    2,
    16,
    f,
    3
);


-- 插入用戶數據
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) 
VALUES 
(1, 'Alice', 'alice@example.com', '$2y$10$examplepasswordhash1', '2024-12-16 16:35:48'),
(2, 'Bob', 'bob@example.com', '$2y$10$examplepasswordhash2', '2024-12-16 16:35:48');

-- 插入筆記數據
INSERT INTO `notes` (`id`, `creator_id`, `title`, `content`, `updated_at`) 
VALUES 
(1, 1, 'Alice\'s Note', 'This is a note created by Alice.', '2024-12-16 16:35:48'),
(2, 2, 'Bob\'s Note', 'This is a note created by Bob.', '2024-12-16 16:35:48');

-- 插入筆記權限數據
INSERT INTO `note_auths` (`user_id`, `note_id`, `can_read`, `creator_id`)
VALUES 
(2, 1, 1, 1), -- Bob has read permission on Alice's note
(1, 2, 1, 2); -- Alice has read permission on Bob's note


--password for user is shortpass

-- 嘗試插入無效筆記數據（無效的 creator_id）
INSERT INTO `notes` (`id`, `creator_id`, `title`, `content`, `updated_at`) 
VALUES 
(3, 999, 'Invalid Note', 'Note with an invalid creator_id.', '2024-12-24 16:35:48'); -- 這應該會失敗

-- 嘗試插入無效的筆記權限數據（無效的 user_id 和 note_id）
INSERT INTO `note_auths` (`user_id`, `note_id`, `can_read`, `creator_id`)
VALUES 
(99129, 1, 1, 1), -- 無效的 user_id
(2871823, 999, 1, 1); -- 無效的 note_id

-- 更新筆記的 creator_id 為有效的用戶 ID
UPDATE `notes` SET `creator_id` = 2 WHERE `id` = 1; -- 應該成功

-- 更新筆記的 creator_id 為無效的用戶 ID
UPDATE `notes` SET `creator_id` = 99129 WHERE `id` = 1; -- 應該失敗

-- 更新筆記的 creator_id 為有效的用戶 ID
UPDATE `notes` SET `creator_id` = 2 WHERE `id` = 1; -- 這應該成功

-- 更新筆記的 creator_id 為無效的用戶 ID
UPDATE `notes` SET `creator_id` = 999 WHERE `id` = 1; -- 這應該會失敗

-- ------------------測試刪除外鍵的數據

-- 刪除有關聯筆記的用戶
DELETE FROM `users` WHERE `id` = 1; -- 這應該會失敗，因為有筆記和權限依賴於這個用戶

-- 刪除有關聯權限的筆記
DELETE FROM `notes` WHERE `id` = 1; -- 這應該會失敗，因為有權限依賴於這個筆記

-- 刪除筆記權限數據
DELETE FROM `note_auths` WHERE `user_id` = 2 AND `note_id` = 1; -- 這應該成功

-- 現在可以刪除筆記
DELETE FROM `notes` WHERE `id` = 1; -- 這應該成功