#!/bin/sh

mysql -h localhost -u root -p < $SYSCAP/database/syscap.sql
