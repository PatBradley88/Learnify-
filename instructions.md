1) If you have the repo on your PC already, navigate to it in your command line with the "cd" command (i.e. 'cd user/documents/Learnify-')

2) Do " git pull " to download the latest version of the repo and all files that have been added since you last committed

3) Open files that need to be edited in your coding environment, or create new files as needed.

4) save files in the appropriate folders

5) do " git add . " - "git add" will add whatever you want to the repo, the "." is needed to add everything (you can specify individual files names instead of the . if you want, just type the full path to the file name, like " git add Learnify/assets/js/register.js" and this will just add the file register.js that is in the js folder inside assets).

6) " git commit -a -m 'your message here' " - so this command just commits your changes to the repo, you include a message to indicate the changes you made. The -m argument is include the message to the repo, the -a argument is to add the message just to the files that were added/changed.

7) do " git push origin master " to finalise the changes.