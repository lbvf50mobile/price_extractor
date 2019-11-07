urls = {
    'shop4audio' => 'https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/',
    'rcshoprs' => 'https://rcshop.rs/proizvod/dji-phantom-4-pro-plus-sa-dve-dodatne-baterije/'
}

p urls
cur_dir = __dir__


require 'net/http'
require 'colorize'

urls.each do |file,url|
    p filepath ="#{cur_dir}/#{file}"
    if ! File.exist?(filepath)
        puts "Downloading: %s" % [url.green]
        uri = URI.parse(url)
        p uri
        content = Net::HTTP.get(uri)
    end
end