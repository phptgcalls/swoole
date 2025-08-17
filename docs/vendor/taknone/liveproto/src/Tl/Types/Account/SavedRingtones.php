<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<Document> ringtones
 * @return account.SavedRingtones
 */

final class SavedRingtones extends Instance {
	public function request(int $hash,array $ringtones) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc1e92cc5);
		$writer->writeLong($hash);
		$writer->tgwriteVector($ringtones,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['ringtones'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>