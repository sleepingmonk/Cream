# Cream by sleepingmonk

## Description

Cream is a command line application written in PHP that uses a simple voting mechanism to compare an arbitrary number of items across an arbitrary number of dimensions. It returns a report of the results in a table format so you can see what rises to the top for each dimension as well as overall.

## Installation

`composer global require sleepingmonk/cream`

Make sure your global composer bin directory is in your path.

## Usage

```
Usage:
  bin/cream [options] [--] [<file>]

Arguments:
  file                  The file to cream.

Options:
  -r, --report          Show report for existing file.
  -h, --help            Display help for the given command. When no command is given display help for the bin/cream command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

Only use the filename without the extension, Cream will append `.json` to the filename you enter.

If you do not enter a filename, Cream will prompt you for one.

If you enter a filename that does not exist, Cream will create it in the directory you are running the command from.

If you enter a filename that exists, Cream will repeat the voting process and items will accumulate more votes. So you can run the same file multiple times to refine the results, sampling responses in different moods, with different perspectives over a period of time, or even with different people to get a consensus.

### Process
Once you have a filename, Cream will prompt you for items to compare. You can enter as many as you like. When you are done, enter nothing.

Cream will then prompt you for dimensions to compare the items on. You can enter as many as you like. When you are done, enter nothing.

Cream will then prompt you to compare each item to each other item for each dimension. Press 1 for the item on the left or 0 for the item on the right. If you enter anything else, Cream will prompt you again.

When you are done, Cream will show you the results in a table format.

## Example

```
$ cream restaurants

Could not open file restaurants.json. Creating it.

0 items found in file. Please add at least 2 items.
Type an item for comparison: [enter to finish] kinjo

1 items found in file. Please add at least 1 items.
Type an item for comparison: [enter to finish] gojiro

2 items found in file. Please add at least 0 items.
Type an item for comparison: [enter to finish]

0 dimensions found in file. Please add at least 2 dimensions.
Type a dimension for comparison: [enter to finish] price

1 dimensions found in file. Please add at least 1 dimensions.
Type a dimension for comparison: [enter to finish] quality

2 dimensions found in file. Please add at least 0 dimensions.
Type a dimension for comparison: [enter to finish] service

3 dimensions found in file. Please add at least 0 dimensions.
Type a dimension for comparison: [enter to finish]

Creaming restaurants.json with dimensions: price,quality,service
Let's GO!

------------------ price ------------------

Dimension: price

1) kinjo vs 0) gojiro
Who wins? [1/0]
gojiro wins!

------------------ quality ------------------

Dimension: quality

1) kinjo vs 0) gojiro
Who wins? [1/0]
kinjo wins!

------------------ service ------------------

Dimension: service

1) kinjo vs 0) gojiro
Who wins? [1/0]
kinjo wins!


The cream has risen!

+--------+-------+---------+---------+-------+
| Item   | price | quality | service | Total |
+--------+-------+---------+---------+-------+
| gojiro | 1     | 0       | 0       | 1     |
| kinjo  | 0     | 1       | 1       | 2     |
+--------+-------+---------+---------+-------+
```
