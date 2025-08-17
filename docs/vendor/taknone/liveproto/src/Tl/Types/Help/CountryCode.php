<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string country_code Vector<string> prefixes Vector<string> patterns
 * @return help.CountryCode
 */

final class CountryCode extends Instance {
	public function request(string $country_code,? array $prefixes = null,? array $patterns = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4203c5ef);
		$flags = 0;
		$flags |= is_null($prefixes) ? 0 : (1 << 0);
		$flags |= is_null($patterns) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($country_code);
		if(is_null($prefixes) === false):
			$writer->tgwriteVector($prefixes,'string');
		endif;
		if(is_null($patterns) === false):
			$writer->tgwriteVector($patterns,'string');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['country_code'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['prefixes'] = $reader->tgreadVector('string');
		else:
			$result['prefixes'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['patterns'] = $reader->tgreadVector('string');
		else:
			$result['patterns'] = null;
		endif;
		return new self($result);
	}
}

?>