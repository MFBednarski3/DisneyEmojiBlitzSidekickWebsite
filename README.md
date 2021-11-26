# DEB Sidekick

## What is DEB Sidekick?

DEBSidekick was a website that helped out with a popular mobile gaming app called "Disney Emoji Blitz". The site ran from March 2020 to March 2022. The site was created to help out players choose a emoji that will work for certain missions. DEB does not tell you what emojis count for that perticular mission. Using data from the [Reddit page of Disney Emoji Blitz](https://www.reddit.com/r/disneyemojiblitz/), I was able to create the website using it. 

## How does it work?

The site provides you with 8 drop down boxes: 3 Tags ("Red", "Big Eared", etc.), 1 Group ("Star Wars", "Mickey and Friends", etc.), 1 Box ("Gold", "Silver", etc.) and 3 Powers ("Generate Stars", "Add Time", etc.). All the drop down boxes are optional and there is no maximum number of drop down boxes that can be filled in. Once you fill in what you want to search for, you hit the **Compute** button. The output than shows the emoji name, box, and group that fits the input. If no emojis meet the input, **No Emojis match your input** displays. If a power drop down box was filled in, the emoji levels would show in addition due to that some emojis use the power at different levels. If multiple powers were searched, only the emojis and levels would show for the ones that use the power at the same time and same level. The website also works for multiple mission tags that can help players get through multiple missions at once.



## What is Disney Emoji Blitz?
Disney Emoji Blitz (DEB) is a Match-3 game which features different Emojis from many Disney franchises including Star Wars. You can download it for *free* on the [App Store](https://apps.apple.com/app/id1017551780) or [Google Play](https://play.google.com/store/apps/details?id=com.disney.emojimatch_goo&referrer=utm_source%3Dko_8c695e46b223008ad%26utm_medium%3D1%26utm_campaign%3Dkoemoji-blitz-google55a93de56c122358f70aa4b8c1%26utm_term%3D%26utm_content%3D%26). 


# How was this updated?

1. I keep all the emoji data in 2 excel spreadsheets: 1 for the tags, groups and boxes and 1 for the powers. 
 - The Tags spreadsheet contains the name of the emoji, the group and the box. I also had series category which was removed due to confusion. Series Category was used to determine the Series number or if it was a standard emoji (can be bought in the gold box) or a diamond emoji (have to first get the emoji from events and then can be leveled up in the gold box) or a group emoji (can only be obtained from group collections). Next, I have columns that specify the tag and for every emoji, I put **Yes** or **No** if they count for the tag. The **Yes** and **No** are colored coded for visual reasons and do not affect anything.
 - The Powers spreadsheet contains the emoji name and columns for the powers with the labels **All, None** or **Some()**. **All** means that all levels of the emoji are able to use this power. **None** means that the emoji doesn't use the power at all. **Some()** means that the power is only used at some of the levels. In between the parenthesis are numbers which are the levels that the emoji uses the power. Once again, it is color coded for visual reasons and do not affect anything.
 
2. After updating the spreadsheets with the new data (or updating), I convert both of them into CSVs (Comma Separated Values). To convert to an Excel to a CSV, go to File -> Save As -> Change File Format to CSV. Make sure to save a Backup Excel file first!!! I use this to convert them to import then into an SQL database. I used [SQLite](https://sqlite.org/index.html) for the site. I also used [SQLite Studio](https://sqlitestudio.pl/features/) to import, visually, easily see the data. 
- If a new mission tag was added, I deleted the tables and manually recreated the table for the columns and then imported the CSV into the table. All fields are a VARCHAR data type. If you are not familar with SQL you can use a CSV to SQL Converter like [here](https://www.convertcsv.com/csv-to-sql.htm). First open the SQLite Studio and open a SQL editor by going to Tools -> Open SQL editor. Type in `Drop Table DEBTags` and then press the play button. Then, using the CSV-SQL converter, import the CSV file. After importing the CSV file, under **Schema.Table or View Name**, type in **DEBTags** and then scroll to the bottom and click on **CSV to SQL INSERT**. After that, in the text box, copy the text from **CREATE TABLE...** to **);**. Paste the code into the SQL editor in SQLite Studio and press the play button. If successfully, the table should be created. Now to add the data, right click on DEBTags and select **Import into Table**. This is where you put in the CSV.

- If no mission tags were added, I simply drop all the records and reimport from the new CSV without deleting the entire table. To do this open an SQL editor in SQLite Studio and type in `Delete from DEBTags` and press the play button. Then repeat with `Delete from DEBPowers`. After that, right click on DEBTags and select **Import into Table**. This is where you put in the CSV. Repeat the same for DEBTags. 

 3. After all the new data has been put into the database, I get the **.db** file which is the embedded database for all of the data. I copy that and paste it into my DEBSidekick/db folder.
 4. I go to my PHP program which is where the website design and the functionality happen. 
 - First, I edit the front page news telling what the website has been updated to and any news to mention
 - Second, I go to my **.js (JavaScript)** file and add in any new group and/or mission tags if necessary.
 - Third, I work on any new functionality to make the website working and enjoyable. For more information, see the PHP, CSS and JS files for detailed functionality.
 - Forth, I test the site to make sure no fatal error messages show. To test the site I use PHP's built in web server functionality. For more info, click [here](https://www.php.net/manual/en/features.commandline.webserver.php). This works easily on Linux or MacOS computers. If you have a Windows computer, it may be difficult to set up.
 
5. Once all the updates have been made, I transferred all my files into the website's **WWW** root using [FileZilla](https://filezilla-project.org/). After that, I posted on the DEB subreddit about the new update. And then that is all until the next update!


## Can I make a version off this?
Sure! I hate to see many people struggle with the mission tags. You can create a new DEB Sidekick site (with or without a different name) or even make a mobile app! You can make any changes to the code, design, but I do ask that the code in this repository **DOES NOT** change. If you want to create your own DEB Sidekick website, copy or download the code in put it in your repository. From there, you can whatever changes you like.
 
 