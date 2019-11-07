urls = {
    'shop4audio' => 'https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/',
    'rcshoprs' => 'https://rcshop.rs/proizvod/dji-phantom-4-pro-plus-sa-dve-dodatne-baterije/'
}

cur_dir = __dir__


require 'colorize'
require 'nokogiri' 
urls.each do |file,url|
    filepath ="#{cur_dir}/#{file}"
    if ! File.exist?(filepath)
        puts "No such file %s" % file.red
        next
    else
        puts "File exists %s" % file.green
    end
    page = Nokogiri::HTML(File.read(filepath))
    page.xpath('//script[@type="application/ld+json"]').each do |scr|
        p scr.class
    end
end