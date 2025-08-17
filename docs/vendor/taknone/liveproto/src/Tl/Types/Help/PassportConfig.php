<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int hash datajson countries_langs
 * @return help.PassportConfig
 */

final class PassportConfig extends Instance {
	public function request(int $hash,object $countries_langs) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa098d6af);
		$writer->writeInt($hash);
		$writer->write($countries_langs->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readInt();
		$result['countries_langs'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>