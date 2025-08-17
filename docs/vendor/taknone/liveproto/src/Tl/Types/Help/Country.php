<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string iso2 string default_name Vector<help.CountryCode> country_codes true hidden string name
 * @return help.Country
 */

final class Country extends Instance {
	public function request(string $iso2,string $default_name,array $country_codes,? true $hidden = null,? string $name = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc3878e23);
		$flags = 0;
		$flags |= is_null($hidden) ? 0 : (1 << 0);
		$flags |= is_null($name) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($iso2);
		$writer->tgwriteBytes($default_name);
		if(is_null($name) === false):
			$writer->tgwriteBytes($name);
		endif;
		$writer->tgwriteVector($country_codes,'help.CountryCode');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['hidden'] = true;
		else:
			$result['hidden'] = false;
		endif;
		$result['iso2'] = $reader->tgreadBytes();
		$result['default_name'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['name'] = $reader->tgreadBytes();
		else:
			$result['name'] = null;
		endif;
		$result['country_codes'] = $reader->tgreadVector('help.CountryCode');
		return new self($result);
	}
}

?>