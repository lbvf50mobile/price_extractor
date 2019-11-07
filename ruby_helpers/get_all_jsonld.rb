# This file extraxt all Json strings from the  HTML files

urls = {
    'shop4audio' => 'https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/',
    'rcshoprs' => 'https://rcshop.rs/proizvod/dji-phantom-4-pro-plus-sa-dve-dodatne-baterije/'
}

cur_dir = __dir__


require 'colorize'
require 'nokogiri' 
require 'fileutils'
urls.each do |file,url|
    filepath ="#{cur_dir}/#{file}"
    dir = "#{cur_dir}/#{file}_jsonld"
    FileUtils.mkdir_p(dir)
    if ! File.exist?(filepath)
        puts "No such file %s" % file.red
        next
    else
        puts "File exists %s" % file.green
    end
    page = Nokogiri::HTML(File.read(filepath))
    page.xpath('//script[@type="application/ld+json"]').each_with_index do |script,index|
        puts "#{index}.json #{script.class}".yellow
        File.write("#{dir}/#{index}.json", script.text)
    end
end