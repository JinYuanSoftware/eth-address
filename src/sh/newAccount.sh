#!/bin/bash
inputPassword = $1

geth account new
expect "*password*"
send "${inputPassword}\n"
expect eof