<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument id bool unsave
 * @return account.SavedRingtone
 */

final class SaveRingtone extends Instance {
	public function request(object $id,bool $unsave) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3dea5b03);
		$writer->write($id->read());
		$writer->tgwriteBool($unsave);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>