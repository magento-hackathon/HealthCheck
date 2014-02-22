#!/bin/zsh
rm modman
for f in  $(find * -type f -not -path '*\/.*')
    do
    if [ $f != 'loop.sh' ]
        then
           echo $f   $f >> modman
    fi
    done
