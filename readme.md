PROJECT DOCUMENTATION

INSTALLATION:
- Requires WP 5.5+
- Activate the theme. (this should auto-create the Stock Recommendation category and setup a caching folder for the API calls)

General Notes:
- Bootstrap Starter Theme was the base for this.
- News Articles are just regular posts
- Since they follow the same format, Stock Recommendations are regular posts with the addition of Stock Recommendation category
- I prefer caching when making API calls. Default directory is set to ../uploads/companyinfo/. I currently have it set on a 15min expiration 
- In production, I would probably build in a few more "idiot-proof" features to lock down certain user-submitted fields (like the Stock Symbol taxonomy) to prevent typos or weird formatting, but for the project, I'm assuming the recommended pattern will be followed.
- With almost all of these stories, I had multiple solutions for implementation, but ultimately settled on the submitted code. 
  --Examples:
   - For assigning stock symbols I considered custom fields that a user could define on post edits stored in postmeta
   - I considered initializing theme functionalities as a plugin
   - I initially setup theme options for the api key and upload dir etc, but decided it was too overkill for this project

FWIW, I also used multiple variations to implement things code-wise (if/else, switch/case, procedural and OOP through Stock class, calling parts w/ and w/o args, custom taxonomies, etc). I also had custom post types, but it didnt seem needed. Some of it is kinda basic, but just wanted to point it out.

My Files:
- category-stock-recommendations.php
- class.stock.php
- functions-tmf.php
- page-companyinfo.php
- sidebar.php
- single.php
- template-parts/content-*
- template-parts/sidebar-*



### Story 1: Create a News article
A News article has the following requirements:

1. The author needs to be able to write and edit the article.
2. The author needs to be able to associate the article with the ticker symbol for the stock being discussed, if any, e.g. NASDAQ:SBUX.
3. Once published, the article needs to display the following:
    1. The author’s name
    2. The date that the article was published
    3. The article itself


Solution:
1. This is handled by the default structure for Posts. 
2. This is handled by assigning a custom Taxonomy "Stock Symbol" found in right hand of edit screen. FORMAT = EXCHANGE:SYMBOL (e.g. NASDAQ:AAPL)
3. Self Explanatory

Note: Essentially all posts are considered News Articles. 



### Story 2: Create a Stock Recommendation article
The Stock Recommendation article has the following requirements:

1. The author needs to be able to write and edit the article.
2. The author needs to be able to associate the article with the ticker symbol for the stock being recommended, e.g. NASDAQ:SBUX.
3. Once published, the article needs to display the following:
    1. The author’s name
    2. The date that the recommendation was published
    3. The article itself
    4. In a sidebar or callout box, it should display the following pieces of company profile information, which will come from an API call (see note below):
        *   Company Logo
        *   Company Name
        *   Exchange
        *   Description
        *   Industry
        *   Sector
        *   CEO
        *   Website URL

Solution:
1. This is handled by the default structure for Posts.
2. This is handled by assigning a custom Taxonomy "Stock Symbol" found in right hand of edit screen. FORMAT = EXCHANGE:SYMBOL (e.g. NASDAQ:AAPL)
3. Subtasks 1-3 are self-explanatory. If the article has category "stock-recommendation" AND a defined "Stock Symbol", the sidebar will be activated and pull in desired company info.

NOTE: To be considered a Stock Recommendation, the article must have the category "Stock Recommendation". If I had more time, I would've wanted to split the description into smaller, more readable paragraphs, but I didnt prioritize that.



### Story 3: Create a Stock Recommendation archive page
The Stock Recommendation archive page should include the following:

1. A list of links to all of the Stock Recommendation articles that have been published, in reverse chronological order (newest first), showing 10 at a time
2. Each Stock Recommendation should show the title of the article as well as the ticker symbol, e.g. “Buy Starbucks (NASDAQ:SBUX)”

Solution:
1. This is handled by the default structure for Archives. Note: it will follow system settings for posts per page.
2. Self explanatory

Accessible at: /category/stock-recommendation/

### Story 4: Create a Company Page
We want a page on the site for each company that we write about. The Company Page should include the following:

1. The name of the company and the company logo in the header
2. A description of the company
3. A side box or table that contains the following financial data, which will come from an API call (see note below):
    *   Price
    *   Price change
    *   Price change in percentage
    *   52 week range
    *   Beta
    *   Volume Average
    *   Market Capitalisation
    *   Last Dividend (if any, otherwise display “N/A”)
4. If the company has been recommended, a list of links to the recommendation articles should be displayed under the header “Recommendations”, in reverse chronological order (newest first).
5. Any News articles should be listed under the header “Other Coverage” in reverse chronological order (newest first). If there are more than 10 articles, the user should be able to page through them. Subsequent pages should contain everything _except_ the list of Recommendation articles. 

Solution:
1-5. Self Explanatory

Note: Company Pages do not "exist" in the database/WP, they are dynamically created. All one needs to do is pass the "long form" stock symbol to /company/ and the page is dynamically built. If I had more time, I would've wanted to split the description into smaller, more readable paragraphs, but I didnt prioritize that.

Accessible at: /company/EXCHANGE:SYMBOL/ (e.g. /company/NASDAQ:AAPL/)


