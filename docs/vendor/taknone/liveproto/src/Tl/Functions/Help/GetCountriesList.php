<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code int hash
 * @return help.CountriesList
 */

final class GetCountriesList extends Instance {
	public function request(string $lang_code,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x735787a8);
		$writer->tgwriteBytes($lang_code);
		$writer->writeInt($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>