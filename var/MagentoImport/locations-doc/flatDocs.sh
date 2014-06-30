for file in {
	/c/Projects/rof/code/dev/var/MagentoImport/locations/*/*.doc,
	/c/Projects/rof/code/dev/var/MagentoImport/locations/*/*/*.doc
};
do
	new_file1 = ${file/\/c\/Projects\/rof\/code\/dev\/var\/MagentoImport\/locations/batch};
	new_file2 = ${new_file1//[\/\ ]/\-};
	new_file3 = ${new_file2/\-[0-9]/};
	new_file  = ${new_file3/batch\-/batch\/};
	
	cp "$file" "./$new_file";
done;
