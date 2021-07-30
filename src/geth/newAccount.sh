#!/bin/bash
geth account new
inputPassword = $1
expect "password" {send "${inputPassword}"}
expect eof