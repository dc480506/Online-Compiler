schroot -l --all-sessions | grep 'session' | while read line; do sudo schroot -e -c "$line"; done
#sudo find /var/chroot/bionic/var/runfolder/ -mindepth 1 -type d -cmin +1 -delete
