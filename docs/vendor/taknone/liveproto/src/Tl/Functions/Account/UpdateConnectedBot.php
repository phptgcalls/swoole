<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot inputbusinessbotrecipients recipients true deleted businessbotrights rights
 * @return Updates
 */

final class UpdateConnectedBot extends Instance {
	public function request(object $bot,object $recipients,? true $deleted = null,? object $rights = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x66a08c7e);
		$flags = 0;
		$flags |= is_null($deleted) ? 0 : (1 << 1);
		$flags |= is_null($rights) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($rights) === false):
			$writer->write($rights->read());
		endif;
		$writer->write($bot->read());
		$writer->write($recipients->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>