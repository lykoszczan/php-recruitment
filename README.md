Importer
=======================

In this test you are asked to build a simple application which imports data from one source and writes them into another.

In real work we are using lots of external libraries to speedup our work or share codebase between projects,
ability to putting them together in elegant way improves cooperation between coworkers and makes projects easy to 
maintain. This test will challenge you to integrate few components in order to solve a simple problem.

In `./tests` we have put `ApplicationTest.php` file which should be treated as specification. 
Your job is to make sure that all of the tests in that file pass successfully.

# Notes

## Library mocks

In `./stubs` directory we have put some libraries which should be integrated with app. Note that there are classes that are fake implementations of database connection and email writing - for this assignment, we can assume it will remain so.

# What you can do

- Write your code in `./src` directory.
- Modify composer.json if you need.
- Fix any errors in given codebase - `./stubs` and `./src`.

# What you can not

- Enrich any code in `./stubs` - treat this code as external libraries. But remember, you are allowed to fix errors, if you find any.

## What will we grade

- Code architecture
- Use of design patterns
- Code style
- Clarity of the solution
- How code is tested

## How run tests
- Ensure that you have docker and docker-compose
- Run `docker-compose -f ./docker/docker-compose.yml run -u app piwik_recrutment_task test`

If anything is not clear, or you have any question do not hesitate to ask them by email! 

Good luck!
