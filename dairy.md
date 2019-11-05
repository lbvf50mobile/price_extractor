
## Diary and ToDo

### 2019.11.05 Tuesday November

- `11:53` I want to reduce time of testing for this purpose I going to create an object. On creation this object get list of urls and files. For urls it create cache, files it just read. and it retun set of htmls as a [DomeNodeList](https://www.php.net/manual/en/class.domnodelist.php)
    - Set list of *urls* and *files* into the constructor
    - object is [Traversable](https://www.php.net/manual/en/class.traversable.php) loop over it. On each iteration it has **html** and **type** properties.
    - **Puropse of this task: 1) reduce amount of testing time do not leach the HTML from the internet. 2) Ability to create test cases myslef for examile a case when Offerst could have array of be a single state object saved by this key.**
- `14:01` Start implementing.