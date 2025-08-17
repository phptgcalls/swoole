<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<help.Country> countries int hash
 * @return help.CountriesList
 */

final class CountriesList extends Instance {
	public function request(array $countries,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x87d0759e);
		$writer->tgwriteVector($countries,'help.Country');
		$writer->writeInt($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['countries'] = $reader->tgreadVector('help.Country');
		$result['hash'] = $reader->readInt();
		return new self($result);
	}
}

?>